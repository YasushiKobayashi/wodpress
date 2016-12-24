#!/bin/sh
LATEST_FILE="`cd $2 && ls | grep "$1-1" | head -n 2`"
FILE=`echo ${LATEST_FILE} | sed -e "s/[\r\n]\+//g"`
cd $2 && composite -compose difference $FILE "$1-"diff.jpg
diff=`identify -format "%[mean]" "$1-"diff.jpg`
if [ $diff != 0 ] ; then
  echo $diff
  echo "前回のテストとの差分が発生しています。$1-diff.jpgを確認してください。"
fi
