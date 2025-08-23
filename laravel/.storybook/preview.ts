import type { Preview } from "@storybook/vue3";
import "../resources/css/app.css";

const preview: Preview = {
  tags: [
    // 自動で Doc を生成する。無効にしたい場合は、各ファイルで ["!autodocs"] を指定する
    "autodocs",
  ],
  parameters: {
    controls: {
      matchers: {
        color: /(background|color)$/i,
        date: /Date$/i,
      },
    },
  },
};

export default preview;
