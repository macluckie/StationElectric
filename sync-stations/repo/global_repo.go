package repo

type GlobalRepo struct {
	RepoHttp
	Repo
}

func NewGlobalRepo(rpHttp RepoHttp, rp Repo) *GlobalRepo {
	rpg := GlobalRepo{}
	rpg.RepoHttp = rpHttp
	rpg.Repo = rp
	return &rpg
}
