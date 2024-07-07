[![Coverage Status](https://coveralls.io/repos/github/kayobruno/minha-quadra/badge.svg?branch=main)](https://coveralls.io/github/kayobruno/minha-quadra?branch=main)

# Set Reserve


### Backend Application Setup
> [!CAUTION]
> **Requires [Docker](https://www.docker.com/)**

Run the command below to start the Application:
```bash
make serve
```

After that you can click [here](http://localhost) to access application.
Use this credentials:
```
email: admin@local.com
pass: admin123
```

### Quick Commands


👨‍💻 Build Application:
> Run this command when you make changes to the Dockerfile.
```bash
make build
```

🕹️ Connect on PHP Container:

```bash
make bash
```

🧪 Run all tests:
```bash
make test
```

📐 Run Linter
```bash
make lint
```
---


### Frontend Application Setup
> [!CAUTION]
> **Requires [Node and NPM](https://nodejs.org/)**

Install Frontend Dependencies
```bash
npm install
```

Compile the Assets
```bash
npm run dev
```

> [!IMPORTANT]
> During development, you can use the npm run watch command to watch changes to frontend files and automatically recompile:
```bash
npm run watch
```
