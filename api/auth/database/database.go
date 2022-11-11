package database

import (
	"auth/config"
	"fmt"
	"gorm.io/driver/postgres"
	"gorm.io/gorm"
)

type Database struct {
	db *gorm.DB
}

func (d Database) Db() *gorm.DB {
	return d.db
}

func newDatabase(db *gorm.DB) *Database {
	return &Database{db: db}
}

func CreateDatabaseConnection(r config.Reader) (*Database, error) {
	dsn := createDsn(
		r.DatabaseConfigReader.ReadDatabaseHost(),
		r.DatabaseConfigReader.ReadDatabaseUser(),
		r.DatabaseConfigReader.ReadDatabasePassword(),
		r.DatabaseConfigReader.ReadDatabaseName(),
		r.DatabaseConfigReader.ReadDatabasePort(),
	)

	db, err := gorm.Open(
		postgres.New(
			postgres.Config{DSN: dsn},
		), &gorm.Config{},
	)

	return newDatabase(db), err
}

func createDsn(host string, user string, password string, name string, port int32) string {
	return fmt.Sprintf("host=%s user=%s password=%s dbname=%s port=%d", host, user, password, name, port)
}
