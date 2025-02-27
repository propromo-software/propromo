package github

import (
	"context"
	"github.com/google/go-github/v67/github"
	"propromo/utils"
)

func ListGitHubMilestones(token *string, repo utils.GitRepo) ([]*github.Milestone, error) {
	ctx := context.Background()
	client := NewGitHubClientWithOptionalToken(token)

	milestones, _, err := client.Issues.ListMilestones(ctx, repo.Owner, repo.Repository, nil)
	return milestones, err
}

func CreateGitHubMilestone(token string, repo utils.GitRepo, milestone *github.Milestone) (*github.Milestone, error) {
	ctx := context.Background()
	client := NewGitHubClient(token)

	milestones, _, err := client.Issues.CreateMilestone(ctx, repo.Owner, repo.Repository, milestone)
	return milestones, err
}
