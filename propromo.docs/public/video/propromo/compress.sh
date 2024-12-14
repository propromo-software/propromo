#!/bin/bash

# needs ffmpeg (`sudo apt install ffmpeg` on debian)

INPUT_DIR="./original"
OUTPUT_DIR="."

mkdir -p "$OUTPUT_DIR"

for input_file in "$INPUT_DIR"/*.mp4; do
    # extract the filename without the extension
    filename=$(basename -- "$input_file")
    filename="${filename%.*}"
    
    output_file="$OUTPUT_DIR/${filename}_compressed.mp4"

    ffmpeg -i "$input_file" -vcodec libx264 -crf 18 -preset slow -acodec copy "$output_file"
done
