package shared

import (
	"auth/config"
	"auth/database"
	"database/sql"
	"testing"
)

func TestGormAccountRepository_FindAccountByEmail_ShouldReturnFalse_WhenAccountNotFound(t *testing.T) {
	db, err := getDatabaseConnection()
	if nil != err {
		t.Fatal(err.Error())
	}
	repository := getAccountRepository(db)

	email, err := NewEmail("test@emai.com")
	if nil != err {
		t.Fatal(err.Error())
	}

	_, found := repository.FindAccountByEmail(email)

	if false != found {
		t.Fail()
	}
}

func TestGormAccountRepository_FindAccountByEmail_ShouldReturnTrue_WhenAccountFound(t *testing.T) {
	db, err := getDatabaseConnection()
	if nil != err {
		t.Fatal(err.Error())
	}
	repository := getAccountRepository(db)

	email, err := NewEmail("test@emai.com")
	if nil != err {
		t.Fatal(err.Error())
	}

	id := "0EBB134F-D9CC-45D1-AEE0-7E0E79F3F06F"
	err = repository.Save(Account{
		Id:       id,
		Email:    email.String(),
		Password: "test_password",
	})

	_, found := repository.FindAccountByEmail(email)

	if true != found {
		t.Fail()
	}

	db.Db().Where("id = @id", sql.Named("id", id)).Delete(Account{})
}

func getDatabaseConnection() (*database.Database, error) {
	var db *database.Database

	reader, err := config.InitConfigReader()
	if err != nil {
		return db, err
	}

	return database.CreateDatabaseConnection(reader)
}
func getAccountRepository(db *database.Database) *GormAccountRepository {
	return NewGormAccountRepository(db)
}
