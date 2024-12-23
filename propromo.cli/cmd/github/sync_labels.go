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

var labelsCmd = &cobra.Command{
	Use:   "labels",
	Short: "Sync labels from one repo to others",
	Run: func(command *cobra.Command, args []string) {
		token := getToken()

		fmt.Println("Syncing from", source, "to", targets)

		sourceRepo, err := utils.ParseGitRepo(source)
		cobra.CheckErr(err)

		labels, err := github.ListGitHubLabels(&token, sourceRepo)
		cobra.CheckErr(err)
		if len(labels) == 0 {
			cmdutils.Logger.Warn("No Labels in source repo found, aborting sync.")
			return
		}

		repos := make([]utils.GitRepo, len(targets))
		for i, target := range targets {
			repo, err := utils.ParseGitRepo(target)
			cobra.CheckErr(err)
			repos[i] = repo
		}

		for _, repo := range repos {
			for _, label := range labels {
				_, err := github.CreateGitHubLabel(token, repo, &githubmodel.Label{
					Name:        label.Name,
					Description: label.Description,
					Color:       label.Color,
				})

				var ghErr *githubmodel.ErrorResponse
				if errors.As(err, &ghErr) && len(ghErr.Errors) == 1 && ghErr.Errors[0].Code == "already_exists" {
					cmdutils.Logger.Info("Label already exists!", "repo", repo.String(), "label", *label.Name)
					continue
				}
				cmdutils.Logger.Info("Label successfully created", "repo", repo.String(), "label", *label.Name)
			}
		}
	},
}

func init() {
	syncFlags(labelsCmd)
}
