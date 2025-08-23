import type { Meta, StoryObj } from "@storybook/vue3";
import CountChip from "./CountChip.vue";

const meta: Meta<typeof CountChip> = {
  title: "Components/Chips/CountChip",
  component: CountChip,
  parameters: {
    layout: "centered",
  },
  argTypes: {
    count: {
      control: { type: "number" },
    },
  },
};

export default meta;
type Story = StoryObj<typeof meta>;

/**
 * 数を表示するシンプルなチップコンポーネント
 */
export const Simple: Story = {
  args: {
    count: 0,
  },
};
