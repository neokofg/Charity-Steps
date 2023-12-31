const Charities = () => {
  return (
    <div>
      <h2 className="font-bold text-[30px] xl:text-[48px] mt-20">
        Благотворительные организации
      </h2>
      <div className="flex justify-between overflow-hidden bg-white rounded-[24px] pl-16 pt-14 mt-10">
        <div>
          <div className="bg-[#eff6ff] rounded-[24px] w-4/5 xl:w-2/6 py-2">
            <p className="font-medium text-[24px] text-[#2563eb] text-center">
              Развивайте свое движение
            </p>
          </div>
          <p className="font-medium text-[16px] xl:text-[32px] pb-5 xl:pb-0 text-black mt-7 w-4/5">
            Мы помогаем благотворительным организациям активировать, привлекать
            и удерживать своих лучших сторонников среди широких масс и
            корпораций.
          </p>
        </div>
        <img className="hidden xl:inline" src="/charityimg.png" alt=" " />
      </div>
    </div>
  );
};

export default Charities;
