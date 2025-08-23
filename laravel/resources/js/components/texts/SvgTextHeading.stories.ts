import type { Meta, StoryObj } from "@storybook/vue3";
import SvgTextHeading from "./SvgTextHeading.vue";
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import PlusSvg from "@/components/svgs/PlusSvg.vue";
import TrashSvg from "@/components/svgs/TrashSvg.vue";

const meta: Meta<typeof SvgTextHeading> = {
  title: "Components/Texts/SvgTextHeading",
  component: SvgTextHeading,
  parameters: {
    layout: "centered",
  },
  argTypes: {
    text: { control: "text" },
    icon: { control: false },
  },
};

export default meta;
type Story = StoryObj<typeof meta>;

/**
 * ドキュメントアイコン付きの見出し
 */
export const WithDocumentIcon: Story = {
  args: {
    text: "メモリスト",
    icon: DocumentSvg,
  },
  render: (args) => ({
    components: { SvgTextHeading, DocumentSvg },
    setup() {
      return { args, DocumentSvg };
    },
    template: `
      <SvgTextHeading :icon="DocumentSvg" :text="args.text" />`,
  }),
};

/**
 * プラスアイコン付きの見出し
 */
export const WithPlusIcon: Story = {
  args: {
    text: "新しいメモを作成",
    icon: PlusSvg,
  },
  render: (args) => ({
    components: { SvgTextHeading, PlusSvg },
    setup() {
      return { args, PlusSvg };
    },
    template: `
      <SvgTextHeading :icon="PlusSvg" :text="args.text" />`,
  }),
};

/**
 * 長いテキストの見出し
 */
export const WithLongText: Story = {
  args: {
    text: "とても長いタイトルのセクション見出しの例",
    icon: DocumentSvg,
  },
  render: (args) => ({
    components: { SvgTextHeading, DocumentSvg },
    setup() {
      return { args, DocumentSvg };
    },
    template: `
      <SvgTextHeading :icon="DocumentSvg" :text="args.text" />`,
  }),
};

/**
 * 短いテキストの見出し
 */
export const WithShortText: Story = {
  args: {
    text: "設定",
    icon: DocumentSvg,
  },
  render: (args) => ({
    components: { SvgTextHeading, DocumentSvg },
    setup() {
      return { args, DocumentSvg };
    },
    template: `
      <SvgTextHeading :icon="DocumentSvg" :text="args.text" />`,
  }),
};

/**
 * 複数の見出しを並べた例
 */
export const MultipleHeadings: Story = {
  render: () => ({
    components: { SvgTextHeading, DocumentSvg, PlusSvg },
    setup() {
      return { DocumentSvg, PlusSvg };
    },
    template: `
      <div class="space-y-4">
        <SvgTextHeading :icon="DocumentSvg" text="メモ一覧" />
        <SvgTextHeading :icon="PlusSvg" text="新規作成" />
      </div>
    `,
  }),
};
