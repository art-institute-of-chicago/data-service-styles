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
