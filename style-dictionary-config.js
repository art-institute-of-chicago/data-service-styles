export default {
  "source": [
    "tokens/**/*.json"
  ],
  "platforms": {
    "css": {
      "transformGroup": "css",
      "buildPath": "storage/app/public/",
      "files": [
        {
          "destination": "variables.css",
          "format": "css/variables",
          "options": {
            "outputReferences": true,
          }
        }
      ]
    },
    "scss": {
      "transformGroup": "scss",
      "buildPath": "storage/app/public/",
      "files": [
        {
          "destination": "variables.scss",
          "format": "scss/variables",
          "options": {
            "outputReferences": true,
          }
        }
      ]
    }
  }
}
