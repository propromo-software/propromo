package cmd

import (
	"errors"
	"fmt"
	githubmodel "github.com/google/go-github/v67/github"
	"github.com/spf13/cobra"
	"propromo/client/github"
	"propromo/cmdutils"
	"propromo/utils"
)

var milestonesCmd = &cobra.Command{
	Use:   "milestones",
	Short: "Sync milestones from one repo to others",
	Run: func(command *cobra.Command, args []string) {
		token := getToken()
		fmt.Println("Syncing from", source, "to", targets)

		sourceRepo, err := utils.ParseGitRepo(source)
		cobra.CheckErr(err)

		milestones, err := github.ListGitHubMilestones(&token, sourceRepo)
		cobra.CheckErr(err)
		if len(milestones) == 0 {
			cmdutils.Logger.Warn("No Milestones in source repo found, aborting sync.")
			return
		}

		repos := make([]utils.GitRepo, len(targets))
		for i, target := range targets {
			repo, err := utils.ParseGitRepo(target)
			cobra.CheckErr(err)
			repos[i] = repo
		}

		for _, repo := range repos {
			for _, milestone := range milestones {
				_, err := github.CreateGitHubMilestone(token, repo, &githubmodel.Milestone{
					Title:       milestone.Title,
					State:       milestone.State,
					Description: milestone.Description,
					DueOn:       milestone.DueOn,
				})

				var ghErr *githubmodel.ErrorResponse
				if errors.As(err, &ghErr) && len(ghErr.Errors) == 1 && ghErr.Errors[0].Code == "already_exists" {
					cmdutils.Logger.Info("Milestone already exists!", "repo", repo.String(), "milestone", *milestone.Title)
					continue
				}
				cmdutils.Logger.Info("Milestone successfully created", "repo", repo.String(), "milestone", *milestone.Title)
			}
		}
	},
}

func init() {
	syncFlags(milestonesCmd)
}
