package shared

import . "github.com/google/uuid"

type Account struct {
	Id       UUID
	Email    string
	Password string
}

func NewAccount(id UUID, email string, password string) Account {
	return Account{Id: id, Email: email, Password: password}
}
