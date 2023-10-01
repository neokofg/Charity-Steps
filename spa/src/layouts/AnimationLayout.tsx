import type { FC, PropsWithChildren } from "react";
import Welcome from "../components/Welcome.tsx";
import Text from "../components/Text.tsx";
import Benefits from "../components/Benefits.tsx";
import ForCompanies from "../components/ForCompanies.tsx";
import Charities from "../components/Charities.tsx";
import Banner from "../components/Banner.tsx";
import Footer from "../components/Footer.tsx";

import { motion, type Variants } from "framer-motion";

const rightVariants: Variants = {
  offscreen: {
    x: -300,
    opacity: 0,
  },
  onscreen: {
    x: 0,
    opacity: 1,
    transition: {
      type: "spring",
      bounce: 0.4,
      duration: 1.8,
    },
  },
};

const leftVariants: Variants = {
  offscreen: {
    x: 600,
    opacity: 0,
  },
  onscreen: {
    x: 0,
    opacity: 1,
    transition: {
      bounce: 0.4,
      duration: 1.4,
      type: "spring",
    },
  },
};

const AnimationLayout: FC<PropsWithChildren> = (props) => {
  const { children } = props;

  return (
    <>
      {/* {[
        <Welcome />,
        <Text />,
        <Benefits />,
        <ForCompanies />,
        <Charities />,
        <Banner />,
        <Footer />,
      ].map((Component) => (
        <motion.div
          initial="offscreen"
          whileInView="onscreen"
          viewport={{ once: true, amount: 0.8 }}
        >
          <motion.div variants={cardVariants}>{Component}</motion.div>
        </motion.div>
      ))} */}
      <Welcome />
      <Text />
      <motion.div
        initial="offscreen"
        whileInView="onscreen"
        viewport={{ once: true, amount: 0.8 }}
      >
        <motion.div variants={leftVariants}>
          <Benefits />
        </motion.div>
      </motion.div>
      <ForCompanies />
      <motion.div
        initial="offscreen"
        whileInView="onscreen"
        viewport={{ once: true, amount: 0.8 }}
      >
        <motion.div variants={rightVariants}>
          <Charities />
        </motion.div>
      </motion.div>
      <Banner />
      <Footer />
    </>
  );
};

export default AnimationLayout;
