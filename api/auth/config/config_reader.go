package config

import (
	"github.com/spf13/viper"
)

const databaseUser = "DATABASE_USER"
const databasePassword = "DATABASE_PASSWORD"
const databaseName = "DATABASE_NAME"
const databasePort = "DATABASE_PORT"
const databaseHost = "DATABASE_HOST"

type Reader struct {
	DatabaseConfigReader databaseConfigReader
}

type databaseConfigReader struct {
}

func (r databaseConfigReader) ReadDatabaseUser() string {
	return viper.GetString(databaseUser)
}
func (r databaseConfigReader) ReadDatabasePassword() string {
	return viper.GetString(databasePassword)
}
func (r databaseConfigReader) ReadDatabaseName() string {
	return viper.GetString(databaseName)
}

func (r databaseConfigReader) ReadDatabasePort() int32 {
	return viper.GetInt32(databasePort)
}

func (r databaseConfigReader) ReadDatabaseHost() string {
	return viper.GetString(databaseHost)
}

func InitConfigReader() (Reader, error) {
	var err error
	var reader Reader

	viper.SetConfigFile(GetEnvPath().Path())
	err = viper.ReadInConfig()
	if nil != err {
		return reader, err
	}

	return Reader{}, err
}
