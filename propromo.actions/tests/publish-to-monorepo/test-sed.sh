#!/bin/bash

input=$(cat <<-EOF
Do something (my/repo#30)
Do smth else (#30, #30)
This matches #30
This wont have to be replaced be/cause#30
This will not m#30tch
Will this match? #30 #40 #50
EOF
)

echo "$input" | perl -pi -e 's/(?<=\W)(#|GH-)(\d+)(?=\W|$)/propromo#$2/gm'
