package create_user_account

import (
	"auth/config"
	"auth/database"
	"auth/src/shared"
	"database/sql"
	"testing"
)

func TestHandle_ShouldPass_WhenUserAccountWasSuccessfullyCreated(t *testing.T) {
	db, err := getDatabaseConnection()
	if nil != err {
		t.Fatal(err.Error())
	}

	repository := getAccountRepository(db)
	command, err := getCommand()
	if nil != err {
		t.Fatal(err.Error())
	}

	err = handle(command, repository)
	if nil != err {
		t.Fatal(err.Error())
	}

	err = db.Db().First(&shared.Account{}, "id = ?", command.id.String()).Error

	if nil != err {
		t.Fail()
	}

	db.Db().Where("id = @id", sql.Named("id", command.id)).Delete(shared.Account{})
}

func TestHandle_ShouldPass_WhenAccountWithProvidedEmailAlreadyExistsAndErrorIsReturned(t *testing.T) {
	db, err := getDatabaseConnection()
	if nil != err {
		t.Fatal(err.Error())
	}

	repository := getAccountRepository(db)
	command, err := getCommand()
	if nil != err {
		t.Fatal(err.Error())
	}

	err = repository.Save(shared.Account{
		Id:       command.id.String(),
		Email:    command.email.String(),
		Password: command.password.String(),
	})
	if err != nil {
		t.Fatal(err.Error())
	}

	err = handle(command, repository)

	if err.Error() != newNotUniqueEmailError().Error() {
		t.Fail()
	}

	db.Db().Where("id = @id", sql.Named("id", command.id)).Delete(shared.Account{})
}

func getCommand() (createUserAccountCommand, error) {
	var err error

	id, err := shared.NewAccountId("D6A7520E-26EA-41B5-9183-9D14745D697C")
	if nil != err {
		return createUserAccountCommand{}, err
	}

	email, err := shared.NewEmail("test@email.com")
	if nil != err {
		return createUserAccountCommand{}, err
	}

	return newCreateUserAccountCommand(id, email, shared.NewPassword("test_password")), err
}

func getDatabaseConnection() (*database.Database, error) {
	var db *database.Database

	reader, err := config.InitConfigReader()
	if err != nil {
		return db, err
	}

	return database.CreateDatabaseConnection(reader)
}
func getAccountRepository(db *database.Database) *shared.GormAccountRepository {
	return shared.NewGormAccountRepository(db)
}
