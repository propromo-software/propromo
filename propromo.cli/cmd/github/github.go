package cmd

import (
	"github.com/spf13/cobra"
)

var GithubCmd = &cobra.Command{
	Use:   "github",
	Short: "Github-related utilities",
}

func init() {
	GithubCmd.AddCommand(syncCmd)
}
