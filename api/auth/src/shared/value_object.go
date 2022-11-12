package shared

import (
	"fmt"
	"github.com/google/uuid"
	"net/mail"
)

type (
	AccountId struct {
		id uuid.UUID
	}
	InvalidUuidError struct {
		message string
	}
)

func NewAccountId(id string) (AccountId, error) {
	var err error

	parsedUuid, err := uuid.Parse(id)
	if nil != err {
		return AccountId{}, newInvalidUuidError(fmt.Sprintf("Uuid: %s is invalid", id))
	}

	return AccountId{id: parsedUuid}, err
}

func (id AccountId) String() string {
	return id.id.String()
}

func newInvalidUuidError(message string) InvalidUuidError {
	return InvalidUuidError{message: message}
}

func (err InvalidUuidError) Error() string {
	return err.message
}

type (
	Email struct {
		email string
	}
	InvalidEmailError struct {
		message string
	}
)

func NewEmail(email string) (Email, error) {
	var err error

	address, err := mail.ParseAddress(email)
	if err != nil {
		return Email{}, newInvalidEmailError(fmt.Sprintf("Invalid email address"))
	}

	return Email{email: address.Address}, err
}

func (email Email) String() string {
	return email.email
}

func newInvalidEmailError(message string) InvalidEmailError {
	return InvalidEmailError{message: message}
}

func (err InvalidEmailError) Error() string {
	return err.message
}

type Password struct {
	password string
}

func NewPassword(password string) Password {
	return Password{password: password}
}

func (password Password) String() string {
	return password.password
}
