package create_user_account

import (
	. "auth/src/shared"
	"fmt"
)

type (
	createUserAccountCommand struct {
		id       AccountId
		email    Email
		password Password
	}

	NotUniqueEmailError struct {
	}
)

func newCreateUserAccountCommand(id AccountId, email Email, password Password) createUserAccountCommand {
	return createUserAccountCommand{id: id, email: email, password: password}
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

func isProvidedEmailUnique(email Email, repository AccountRepositoryInterface) bool {
	_, found := repository.FindAccountByEmail(email)

	return false != found
}

func (n NotUniqueEmailError) Error() string {
	return "Cannot create account. Email already exists in database."
}
