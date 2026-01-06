#!/usr/bin/env bash

DIR="$(dirname "$0")"

if [[ $# > 2 ]]; then
	echo
	echo "too many args provided, requires 2 args, page size and json path"
	exit 1
fi

if [[ $# < 2 ]]; then
	echo
	echo "too few args provided, requires 2 args page size and json path"
	exit 1
fi

if [[ ! -f "$2" ]]; then
	echo
	echo "file path \"$2\" does not exist"
	exit 1
fi

INPUT="$(pwd)/$2"

echo
echo "INFO: creating CV from \"$INPUT\", using page size $1"
echo

rm "$DIR/cv.json"
ln -s "$INPUT" "$DIR/cv.json"
php "$DIR/src/php/index.php" > "$DIR/index.html"
wkhtmltopdf --page-size "$1" "$DIR/index.html" "./cv.pdf"
