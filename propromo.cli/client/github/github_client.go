package github

import (
	"github.com/google/go-github/v67/github"
	"propromo/cmdutils"
)

func NewGitHubClient(token string) *github.Client {
	return github.NewClient(nil).WithAuthToken(token)
}

func NewGitHubClientWithOptionalToken(token *string) *github.Client {
	client := github.NewClient(nil)
	if token != nil {
		nonNilToken := *token
		if nonNilToken == "" {
			cmdutils.Logger.Fatal("Empty token passed. Either supply `nil` or a valid GitHub PAT.")
		}
		client = client.WithAuthToken(nonNilToken)
	}
	return client
}
