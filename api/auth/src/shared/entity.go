package shared

type Account struct {
	Id       string
	Email    string
	Password string
}

func NewAccount(id AccountId, email Email, password Password) Account {
	return Account{Id: id.String(), Email: email.String(), Password: password.String()}
}
