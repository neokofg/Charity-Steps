const Welcome = () => {
  return (
    <div className="grid grid-cols-1 xl:grid-cols-2 gap-2">
      <div className="col-span-1 bg-white rounded-[32px] pt-14 pb-5 px-10">
        <div>
          <img
            src="/logo.png"
            alt="CS"
            className="mx-auto xl:mx-0 w-[64px] h-[64px]"
          />
          <h2 className="font-semibold text-center xl:text-left text-[36px] text-[#2563eb] mt-1">
            Charity Steps
          </h2>
          <h1 className="font-bold text-[48px] text-black mt-1">
            КАЖДЫЙ ШАГ ИМЕЕТ ЗНАЧЕНИЕ
          </h1>
          <p className="font-medium text-[24px] text-black mt-3">
            Мы помогаем людям, благотворительным организациям и компаниям
            оказывать влияние на каждом этапе.
          </p>
          <button className="w-full bg-[#2563eb] text-[22px] text-white h-[77px] rounded-[24px] mt-5">
            Скачать приложение
          </button>
        </div>
      </div>
      <div className="col-span-1 bg-[#2563eb] rounded-[32px]">
        <img src="/image-banner.png" alt="Charity Steps" />
      </div>
    </div>
  );
};

export default Welcome;
