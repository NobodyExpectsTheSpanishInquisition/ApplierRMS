package create_user_account

import (
	. "auth/src/shared"
	"fmt"
	. "github.com/google/uuid"
)

type (
	createUserAccountCommand struct {
		id       UUID
		email    string
		password string
	}

	NotUniqueEmailError struct {
	}
)

func newCreateUserAccountCommand(id UUID, email string, password string) createUserAccountCommand {
	return createUserAccountCommand{id: id, email: email, password: password}
}

func (n NotUniqueEmailError) Error() string {
	return "Cannot create account. Email already exists in database."
}

func handle(command createUserAccountCommand, accountRepository AccountRepositoryInterface) error {
	var err error

	if false == isProvidedEmailUnique(command.email, accountRepository) {
		return NotUniqueEmailError{}
	}

	account := NewAccount(command.id, command.email, command.password)
	err = accountRepository.Save(account)

	if err != nil {
		return NewCannotSaveError(fmt.Sprintf("Cannot save account. %s", err.Error()))
	}

	// TODO dispatch AccountCreatedEvent

	return err
}

func isProvidedEmailUnique(email string, repository AccountRepositoryInterface) bool {
	_, found := repository.FindAccountByEmail(email)

	return false != found
}
