---
theme: default

addons:
  - slidev-addon-rabbit
rabbit:
  slideNum: true

title: Presentation
titleTemplate: '%s | Propromo'
author: Jonas Fröller
keywords: propromo,project,progress,monitoring,github,jira
info: |
  # Propromo
  
  Presentation slides for Propromo.

  Learn more at [propromo.docs](https://github.com/propromo-software/propromo.docs)

htmlAttrs:
  dir: ltr
  lang: de

# https://sli.dev/guide/exporting.html
download: true
exportFilename: propromo-slides
export:
  format: pdf
  timeout: 30000
  dark: false
  withClicks: true
  withToc: false

# https://sli.dev/features/drawing
drawings:
  enabled: true
  persist: false

# slide transition: https://sli.dev/guide/animations.html#slide-transitions
transition: slide-left

# enable MDC Syntax: https://sli.dev/features/mdc
mdc: true

# unocss classes
class: text-center

remoteAssets: true
selectable: false
colorSchema: auto

favicon: 'https://propromo-software.github.io/corporate-identity/favicons/favicon.png'
themeConfig:
  primary: '#0D3269'
  darkGray: '#9A9A9A'
  gray: '#CCCCCC'
  lightGray: '#DCDCDC'
  green: '#229342'
  yellow: '#FBC116'
  red: '#E33B2E'

# Uses Google Fonts per default... (https://sli.dev/custom/config-fonts#providers, https://github.com/slidevjs/slidev/issues/1977)

# fonts:
#  # basically the text
#  sans: 'system-ui, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
#  # use with `font-serif` css class from windicss
#  serif: 'Robot Slab'
#  # for code blocks, inline code, etc.
#  mono: 'Fira Code, monospace'
#  headline: '"Koulen", sans-serif'

# https://sli.dev/custom/#headmatter
---

<style lang="postcss">
  @import url('https://api.fonts.coollabs.io/css2?family=Koulen&display=swap'); /* no ü, ö, ä, ß... */

  .koulen-font {
      font-family: "Koulen", sans-serif;
  }

  h1 {
    /* background: #061935; */
    @apply bg-primary text-white rounded-lg px-4 pb-2 pt-3;
      font-family: "Koulen", sans-serif;
      font-weight: 500;
      font-style: normal;
      text-transform: uppercase;
  }
</style>

# Propromo

> <span class="text-3xl">Project Progress Monitoring</span>

---
src: ./pages/intro.md
hide: false
---

---
src: ./pages/problem.md
hide: false
---

---
src: ./pages/statistics-01.md
hide: false
---

---
src: ./pages/solution.md
hide: false
---

---
src: ./pages/project-info.md
hide: false
---

---
src: ./pages/kpis.md
hide: false
---

---
src: ./pages/video.md
hide: false
---

---
src: ./pages/thanks.md
hide: false
---
