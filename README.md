# Demo Livewire Datatable

Easy and simple demo datatable with Livewire. 👍

![Demo Livewire Datatable gif](demo-livewire-datatable.gif)

## Features

Filter, sort, refresh, and delete data in datatable. 🙂

## Requirements

- PHP version 8.1.x
- Node version >= 16.x
- Composer version 2.x
- SQLite

## How to run

- Clone this demo repository
- Run `cp .env.example .env` to create `.env` file by duplicate `.env.example`
- Create database.sqlite with command `touch database/database.sqlite` from root directory
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Run `npm install` (optional)
- Run `npm run dev` (optional)
- Run `php artisan serve`

> *optional: because previously I already compiled asset to `public` dir with `npm run dev` so I think you don't need that.
