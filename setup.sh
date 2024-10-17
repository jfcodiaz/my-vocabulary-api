#!/bin/bash

# Check if .env file exists
if [ ! -f .env ]; then
    # If .env does not exist, copy .env.example to .env
    cp .env.example .env
    echo ".env file created from .env.example"
else
    echo ".env file already exists"
fi

# Run docker compose up with --build option
docker compose up --build
