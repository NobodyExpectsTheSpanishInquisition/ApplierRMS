package create_user_account

import (
	"auth/config"
	"auth/database"
	"auth/src/shared"
	"database/sql"
	"github.com/google/uuid"
	"testing"
)

func TestHandle_ShouldPass_WhenUserAccountWasSuccessfullyCreated(t *testing.T) {
	db, err := getDatabaseConnection()
	if nil != err {
		t.Fatal(err.Error())
	}

	repository := getAccountRepository(db)
	command := getCommand()

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
	command := getCommand()

	err = repository.Save(shared.Account{
		Id:       command.id,
		Email:    command.email,
		Password: command.password,
	})
	if err != nil {
		t.Fatal(err.Error())
	}

	err = handle(command, repository)

	if nil == err {
		t.Fail()
	}

	db.Db().Where("id = @id", sql.Named("id", command.id)).Delete(shared.Account{})
}

func getCommand() createUserAccountCommand {
	accountId, _ := uuid.Parse("A2EA711C-EC4A-4386-A307-D9E375714C33")
	return newCreateUserAccountCommand(accountId, "test@email.com", "$2a$10$VcQUgZvK5xElmfNNeYemtuxSzM.B5bRf9dP5YyMu8QJrYvn.USWa6")
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
