{pkgs}: {
  channel = "stable-23.11";
  packages = [
    pkgs.nodejs_20
    pkgs.php82
    pkgs.php82Packages.composer
  ];

  idx.extensions = [
    "formulahendry.auto-rename-tag"
    "vincaslt.highlight-matching-tag"
    "onecentlin.laravel-blade"
    "codingyu.laravel-goto-view"
    "onecentlin.laravel5-snippets"
    "esbenp.prettier-vscode"
    "bradlc.vscode-tailwindcss"
    "shades.vscode-tailwindcss-shades"
    "ailhic.vscode-tailwindcss-snippets"
    "cweijan.vscode-mysql-client2"
  ];

  env = {
    APP_ENV = "development";
    APP_DEBUG = "true";
    APP_KEY = "base64:9gz9B259gbLAEPDoKyUhezk7hrMse0r0feCXIYzIwy0=";
    APP_URL = "http://localhost";
  };

  services.mysql = {
    enable = true;
  };

  idx.workspace.onStart = {
  };

  idx.previews = {
    previews = {
      backend = {
        command = [
          "php"
          "artisan"
          "serve"
          "--host"
          "0.0.0.0"
          "--port"
          "$PORT"
        ];
        manager = "web";
      };
      web = {
        command = [
          "npm"
          "run"
          "dev"
          "--"
          "--port"
          "$PORT"
          "--host"
          "0.0.0.0"
        ];
        manager = "web";
      };
    };
  };
}