package database

import (
	"auth/config"
	"testing"
)

func TestCreateDatabaseConnection_ShouldReturnDatabaseConnection_WhenCorrectDsnParametersRead(t *testing.T) {
	reader, _ := config.InitConfigReader()
	_, err := CreateDatabaseConnection(reader)

	if nil != err {
		t.Fail()
	}
}
