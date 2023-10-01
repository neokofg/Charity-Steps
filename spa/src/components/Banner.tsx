import BannerSvg from "../assets/icons/BannerSvg";

const Banner = () => {
  return (
    <div className="flex relative overflow-hidden justify-between bg-[#2563eb] rounded-[24px] mt-5 xl:mt-20 pt-10 px-10">
      <div className="text-white pb-5 xl:pb-0">
        <h2 className="font-bold text-[20px] xl:text-[44px] w-[70%]">
          Загрузите приложение — бесплатно! О, и это бесплатно!
        </h2>
        <button className="w-full xl:w-[55%] mt-7 py-5 bg-white rounded-[24px] text-[#2563eb] font-medium text-[24px]">
          Скачать приложение
        </button>
      </div>

      <img className="hidden xl:inline" src="/iphone.png" alt=" " />
    </div>
  );
};

export default Banner;
