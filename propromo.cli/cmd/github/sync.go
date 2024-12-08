package cmd

import (
	"github.com/spf13/cobra"
	"github.com/spf13/viper"
	"propromo/cmdutils"
)

var syncCmd = &cobra.Command{
	Use:   "sync",
	Short: "Syncing utilities for GitHub",
}

var source string
var targets []string

func init() {
	syncCmd.AddCommand(milestonesCmd)
}

func getToken() string {
	token := viper.GetString("token")
	if token == "" {
		cmdutils.Logger.Fatal("No token provided.")
	}
	return token
}

func syncFlags(cmd *cobra.Command) {
	cmd.Flags().String("token", "", "github token")
	cobra.CheckErr(viper.BindPFlag("token", cmd.Flags().Lookup("token")))

	cmd.Flags().StringVarP(&source, "source", "s", "", "Source repository")
	cobra.CheckErr(cmd.MarkFlagRequired("source"))
	cmd.Flags().StringSliceVarP(&targets, "target", "t", []string{}, "Comma-separated target repository(s)")
	cobra.CheckErr(cmd.MarkFlagRequired("target"))
}
