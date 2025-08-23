import type { Meta, StoryObj } from "@storybook/vue3";
import CountChip from "./CountChip.vue";

const meta: Meta<typeof CountChip> = {
  title: "Components/Chips/CountChip",
  component: CountChip,
  parameters: {
    layout: "centered",
  },
  tags: ["autodocs"],
  argTypes: {
    count: {
      control: { type: "number" },
    },
  },
};

export default meta;
type Story = StoryObj<typeof meta>;

export const Simple: Story = {
  args: {
    count: 0,
  },
};
