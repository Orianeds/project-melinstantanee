import React from 'react'

const PortraitPrice = () => {
  return (
    <div className='flex flex-col h-screen textLibre mt-40'>
        {/* Overlay */}
        {/* <div className='absolute flex-row top-0 left-0 right-0 bottom-0 bg-white/10 z-[2]'/> */}
        
        <div className=' bg-white/90 z-[2]  w-[100%] mb-40 text-black text-center'>
            <h2 className='text-3xl font-bold pb-5'>Tarif séance Portrait</h2>
            <h3 className='text-xl font-bold pb-5'>Description</h3>
            <p className=' px-[10rem] text-lg pb-5'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel diam in lacus eleifend iaculis. Quisque eu arcu vel odio tempus cursus eu vel ante. Proin vitae ligula sit amet quam aliquet molestie sed at risus. Morbi nec interdum justo. Nullam bibendum, risus vitae blandit commodo, purus ante pellentesque diam, at pharetra libero lectus id risus. Nullam sem lorem, porttitor et ipsum nec, varius scelerisque justo. Mauris ullamcorper diam nulla, at fermentum ipsum consectetur sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in turpis facilisis, dapibus tellus quis, posuere elit. Donec nunc nibh, aliquet sit amet nisl ac, hendrerit bibendum nunc. Morbi aliquet ex id nibh tempus sagittis. </p>
            <p className='text-xl pb-5'>Durée : 1 heure</p>
            <p className='text-3xl font-bold pb-7'>80€</p>
        </div>

        {/* Overlay */}
        {/* <div className='absolute flex-row top-0 left-0 right-0 bottom-0 bg-white/10 z-[3]'/> */}
    </div>
  )
}

export default PortraitPrice