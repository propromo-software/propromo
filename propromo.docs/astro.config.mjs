import vercel from "@astrojs/vercel/serverless";
import { defineConfig } from "astro/config";
import starlight from "@astrojs/starlight";
import starlightBlog from "starlight-blog";

// https://astro.build/config
// https://docs.astro.build/en/guides/environment-variables/#default-environment-variables
const IS_DEV = import.meta.env.DEV;

export default defineConfig({
  site: IS_DEV ? "http://localhost:4321" : "https://propromo-docs.vercel.app",
  integrations: [
    starlight({
      title: "Propromo Docs",
      favicon: "/img/favicon.png",
      logo: {
        src: "./public/img/favicon.png",
      },
      social: {
        github: "https://github.com/propromo-software/propromo",
      },
      sidebar: [
        { label: "About", link: "/about" },
        {
          label: "Guides",
          items: [
            {
              label: "Joining a Project Monitor",
              link: "/guides/join-monitor/",
            },
            {
              label: "Creating a Project Monitor",
              link: "/guides/create-monitor/",
            },
            {
              label: "Github",
              autogenerate: {
                directory: "/guides/github",
              },
            },
            {
              label: "Jira",
              autogenerate: {
                directory: "/guides/jira",
              },
            },
          ],
        },
        {
          label: "Reference",
          autogenerate: {
            directory: "reference",
          },
        },
      ],
      plugins: [
        starlightBlog({
          authors: {
            jonasfroeller: {
              name: "Jonas Fröller",
              title: "Developer @Propromo",
              picture: "https://avatars.githubusercontent.com/u/121523551?v=4",
              url: "https://jonasfroeller.is-a.dev",
            },
          },
        }),
      ],
      customCss: ["./src/styles/custom.css"],
    }),
  ],
  output: "hybrid",
  adapter: vercel({
    webAnalytics: {
      enabled: true,
    },
  }),
});
