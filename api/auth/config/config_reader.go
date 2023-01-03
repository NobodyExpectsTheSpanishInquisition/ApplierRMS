package config

import (
	"github.com/spf13/viper"
)

const databaseUser = "DATABASE_USER"
const databasePassword = "DATABASE_PASSWORD"
const databaseName = "DATABASE_NAME"
const databasePort = "DATABASE_PORT"
const databaseHost = "DATABASE_HOST"

const amqpUser = "AMQP_USER"
const amqpPassword = "AMQP_PASSWORD"
const amqpHost = "AMQP_HOST"
const amqpPort = "AMQP_PORT"
const amqpQueueName = "AMQP_QUEUE_NAME"

type Reader struct {
	DatabaseConfigReader     databaseConfigReader
	AmqpConsumerConfigReader AmqpConsumerConfigReader
}

func InitConfigReader() (*Reader, error) {
	var err error
	var reader Reader

	viper.SetConfigFile(GetEnvPath().Path())
	err = viper.ReadInConfig()
	if nil != err {
		return &reader, err
	}

	return &reader, err
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

type AmqpConsumerConfigReader struct {
}

func (r AmqpConsumerConfigReader) ReadAmqpConsumerUser() string {
	return viper.GetString(amqpUser)
}

func (r AmqpConsumerConfigReader) ReadAmqpConsumerPassword() string {
	return viper.GetString(amqpPassword)
}
func (r AmqpConsumerConfigReader) ReadAmqpConsumerHost() string {
	return viper.GetString(amqpHost)
}
func (r AmqpConsumerConfigReader) ReadAmqpConsumerPort() int32 {
	return viper.GetInt32(amqpPort)
}

func (r AmqpConsumerConfigReader) ReadAmqpQueueName() string {
	return viper.GetString(amqpQueueName)
}
