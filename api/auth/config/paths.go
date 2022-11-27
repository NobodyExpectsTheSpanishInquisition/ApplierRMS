package config

import (
	"path/filepath"
	"runtime"
)

const envRelativePath = "../.env"
const databaseMigrationsPath = "../database/migrations/"

type Path struct {
	path string
}

func (p Path) Path() string {
	return p.path
}

func NewPath(path string) Path {
	return Path{path: path}
}

func GetEnvPath() Path {
	return NewPath(getAbsolutePath(envRelativePath))
}

func GetMigrationsPath() Path {
	return NewPath(getAbsolutePath(databaseMigrationsPath))
}

func getAbsolutePath(relativePath string) string {
	abs, err := filepath.Abs(filepath.Join(getCurrentPath(), relativePath))
	if err != nil {
		panic(err.Error())
	}

	return abs
}

func getCurrentPath() string {
	_, currentPath, _, _ := runtime.Caller(0)

	return filepath.Dir(currentPath)
}
