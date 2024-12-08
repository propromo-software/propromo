package cmdutils

import (
	"github.com/charmbracelet/log"
	"os"
)

var Logger = log.NewWithOptions(os.Stdout, log.Options{
	ReportCaller:    true,
	ReportTimestamp: true,
})
