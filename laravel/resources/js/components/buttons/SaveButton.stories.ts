import type { Meta, StoryObj } from "@storybook/vue3";
import SaveButton from "./SaveButton.vue";
import PlusSvg from "@/components/svgs/PlusSvg.vue";

const meta: Meta<typeof SaveButton> = {
  title: "Components/Buttons/SaveButton",
  component: SaveButton,
  parameters: {
    layout: "centered",
  },
  argTypes: {
    text: { control: "text" },
    disabled: { control: "boolean" },
    type: {
      control: "select",
      options: ["button", "submit", "reset"],
    },
    ariaLabel: { control: "text" },
  },
};

export default meta;
type Story = StoryObj<typeof meta>;

/**
 * 保存アクションを示すボタンコンポーネント
 */
export const Default: Story = {
  args: {
    text: "メモを保存",
    disabled: false,
    type: "button",
  },
  render: (args) => ({
    components: { SaveButton, PlusSvg },
    setup() {
      return { args };
    },
    template: `
      <SaveButton v-bind="args">
        <PlusSvg color="white" />
      </SaveButton>
    `,
  }),
};

/**
 * 無効化された保存ボタン
 */
export const Disabled: Story = {
  args: {
    text: "保存",
    disabled: true,
    type: "button",
  },
  render: (args) => ({
    components: { SaveButton, PlusSvg },
    setup() {
      return { args };
    },
    template: `
      <SaveButton v-bind="args">
        <PlusSvg color="white" />
      </SaveButton>
    `,
  }),
};

/**
 * フォームの送信ボタンとしての保存ボタン
 */
export const Submit: Story = {
  args: {
    text: "送信",
    disabled: false,
    type: "submit",
  },
  render: (args) => ({
    components: { SaveButton, PlusSvg },
    setup() {
      return { args };
    },
    template: `
      <SaveButton v-bind="args">
        <PlusSvg color="white" />
      </SaveButton>
    `,
  }),
};
