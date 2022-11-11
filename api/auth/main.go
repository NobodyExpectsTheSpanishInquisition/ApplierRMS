package main

import (
	. "auth/config"
	. "auth/database"
)

func main() {
	reader := initConfig()

	db := createDatabaseConnection(reader)
	executeMigrations(db)
}

func initConfig() Reader {
	reader, err := InitConfigReader()
	if nil != err {
		panic(err.Error())
	}

	return reader
}

func createDatabaseConnection(reader Reader) *Database {
	db, err := CreateDatabaseConnection(reader)
	if nil != err {
		panic(err.Error())
	}

	return db
}

func executeMigrations(database *Database) {
	err := ExecuteMigrations(database)
	if nil != err {
		panic(err.Error())
	}
}
