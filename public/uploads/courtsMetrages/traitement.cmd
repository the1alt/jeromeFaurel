FOR %%G IN (*.jpg) DO mogrify -resize 40% "%%G" "output/%%G-min"
