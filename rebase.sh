git stash

git checkout dev
git pull
git fetch --all --prune

git checkout master
git pull
git rebase origin/dev
git push -f origin HEAD

git checkout dev
git rebase origin/master
git push -f origin HEAD

git stash pop