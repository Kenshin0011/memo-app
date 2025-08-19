export const ICON_SIZES = {
  sm: "w-[20px] h-[20px]",
  md: "w-[24px] h-[24px]",
  lg: "w-[28px] h-[28px]",
  xl: "w-[32px] h-[32px]",
} as const;

export type IconSize = keyof typeof ICON_SIZES;
