# Inventory API

This repository contains the backend API for the Inventory Project, built using Laravel and Sanctum for token-based authentication.

## Table of Contents

- [Features](#features)
- [Routes](#routes)
- [Authentication](#authentication)
- [Getting Started](#getting-started)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Features

- User Registration
- User Login
- User Profile
- User Logout
- User Update
- Send OTP
- Verify OTP
- Reset Password

## Routes

### User Routes

- **User Registration:** `POST /user_registration`
  - Registers a new user.

- **User Login:** `POST /login`
  - Logs in an existing user.

- **User Profile:** `GET /userProfile`
  - Retrieves user profile information. Requires authentication.

- **User Logout:** `GET /userLogout`
  - Logs out the authenticated user. Requires authentication.

- **User Update:** `POST /userUpdate`
  - Updates user information. Requires authentication.

- **Send OTP:** `POST /sendOTP`
  - Sends an OTP (One Time Password) for user verification.

- **Verify OTP:** `POST /verifyOTP`
  - Verifies the provided OTP for user authentication.

- **Reset Password:** `POST /resetPassword`
  - Resets the user's password. Requires authentication.

## Authentication

The API uses Laravel Sanctum for token-based authentication. Ensure that you include the appropriate token in the Authorization header for routes that require authentication.

## Getting Started

1. Clone the repository:
   ```bash
   git clone https://github.com/Masum-WebD/API-for-a-invertory-project.git
