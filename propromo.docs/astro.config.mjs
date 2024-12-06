import { defineConfig } from "astro/config";
import starlight from "@astrojs/starlight";
import vercel from "@astrojs/vercel/serverless";

// https://astro.build/config
export default defineConfig({
  site: "https://propromo-docs.vercel.app",
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
        { label: 'About', link: '/about' },
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
      plugins: [],
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
