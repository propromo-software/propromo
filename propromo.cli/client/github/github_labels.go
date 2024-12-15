package github

import (
	"context"
	"github.com/google/go-github/v67/github"
	"propromo/utils"
)

func ListGitHubLabels(token *string, repo utils.GitRepo) ([]*github.Label, error) {
	ctx := context.Background()
	client := NewGitHubClientWithOptionalToken(token)

	labels, _, err := client.Issues.ListLabels(ctx, repo.Owner, repo.Repository, nil)
	return labels, err
}

func CreateGitHubLabel(token string, repo utils.GitRepo, label *github.Label) (*github.Label, error) {
	ctx := context.Background()
	client := NewGitHubClient(token)

	label, _, err := client.Issues.CreateLabel(ctx, repo.Owner, repo.Repository, label)
	return label, err
}
