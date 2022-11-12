package shared

import (
	. "auth/database"
	"database/sql"
	"gorm.io/gorm"
)

type (
	AccountRepositoryInterface interface {
		FindAccountByEmail(email Email) (Account, bool)
		Save(account Account) error
	}
	GormAccountRepository struct {
		db *Database
	}
)

func NewGormAccountRepository(db *Database) *GormAccountRepository {
	return &GormAccountRepository{db: db}
}

func (r GormAccountRepository) FindAccountByEmail(email Email) (Account, bool) {
	var account Account
	err := r.db.Db().First(&account, "email = @email", sql.Named("email", email.String())).Error

	return account, nil != err
}

func (r GormAccountRepository) Save(account Account) error {
	return r.db.Db().Transaction(func(tx *gorm.DB) error {
		return r.db.Db().Create(&account).Error
	})
}

type CannotSaveError struct {
	message string
}

func NewCannotSaveError(message string) CannotSaveError {
	return CannotSaveError{message: message}
}

func (err CannotSaveError) Error() string {
	return err.message
}
