package main

import (
	. "auth/config"
	. "auth/database"
	"log"
)

func main() {
	reader := initConfig()

	db := createDatabaseConnection(reader)
	executeMigrations(db)
}

func initConfig() *Reader {
	reader, err := InitConfigReader()
	if nil != err {
		log.Fatal(err.Error())
	}

	return reader
}

func createDatabaseConnection(reader *Reader) *Database {
	db, err := CreateDatabaseConnection(reader)
	if nil != err {
		log.Fatal(err.Error())
	}

	return db
}

func executeMigrations(database *Database) {
	err := ExecuteMigrations(database)
	if nil != err {
		log.Fatal(err.Error())
	}
}
