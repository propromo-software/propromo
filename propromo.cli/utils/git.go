package utils

import (
	"fmt"
	"strings"
)

type GitRepo struct {
	Owner      string
	Repository string
}

func (repo *GitRepo) String() string {
	return fmt.Sprintf("%s/%s", repo.Owner, repo.Repository)
}

func ParseGitRepo(s string) (GitRepo, error) {
	// parse `org/repo` to `org` and `repo`
	result := strings.Split(s, "/")
	if len(strings.Split(s, "/")) != 2 {
		return GitRepo{}, fmt.Errorf("invalid git repo: %s", s)
	}

	return GitRepo{
		Owner:      result[0],
		Repository: result[1],
	}, nil
}
