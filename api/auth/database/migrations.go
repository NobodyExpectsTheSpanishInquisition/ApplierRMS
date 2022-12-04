package database

import (
	. "auth/config"
	"fmt"
	migrate "github.com/rubenv/sql-migrate"
	"path/filepath"
)

const v1MigrationsPath = "./v1.0.0/"

func ExecuteMigrations(db *Database) error {
	var err error
	migrationsBasePath := GetMigrationsPath()

	err = runV1Migrations(db, migrationsBasePath)
	if err != nil {
		return err
	}

	return err
}

func runV1Migrations(db *Database, migrationsBasePath Path) error {
	var err error

	migrations := &migrate.FileMigrationSource{
		Dir: filepath.Join(migrationsBasePath.Path(), v1MigrationsPath),
	}

	db2, _ := db.db.DB()
	exec, err := migrate.Exec(db2, "postgres", migrations, migrate.Up)
	if err != nil {
		return err
	}

	fmt.Printf("Executed migrations: %d from version: %s", exec, "1.0.0")

	return err
}
