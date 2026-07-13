export default {
  "source": [
    "tokens/**/*.json"
  ],
  "platforms": {
    "scss": {
      "transformGroup": "scss",
      "buildPath": "storage/app/public/",
      "files": [
        {
          "destination": "setup.scss",
          "format": "scss/variables",
          "options": {
            "outputReferences": true,
          }
        }
      ]
    }
  }
}
