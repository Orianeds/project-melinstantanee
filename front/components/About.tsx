import React from 'react'
import Link from 'next/link'

const About = ({message}: {message: string}) => {
    return (
        <div className='flex flex-col h-screen textLibre mb-40'>
            {/* Overlay */}
            {/* <div className='absolute flex-row top-0 left-0 right-0 bottom-0 bg-white/10 z-[2]'/> */}
            
            <div className=' bg-brown z-[2]  w-[100%] mb-40 text-white text-center'>
                <h2 className='text-5xl font-bold pb-7'>Quelques mots</h2>
                <p className=' px-[10rem] text-lg pb-2'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel diam in lacus eleifend iaculis. Quisque eu arcu vel odio tempus cursus eu vel ante. Proin vitae ligula sit amet quam aliquet molestie sed at risus. Morbi nec interdum justo. Nullam bibendum, risus vitae blandit commodo, purus ante pellentesque diam, at pharetra libero lectus id risus. Nullam sem lorem, porttitor et ipsum nec, varius scelerisque justo. Mauris ullamcorper diam nulla, at fermentum ipsum consectetur sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in turpis facilisis, dapibus tellus quis, posuere elit. Donec nunc nibh, aliquet sit amet nisl ac, hendrerit bibendum nunc. Morbi aliquet ex id nibh tempus sagittis. </p>
            </div>

            {/* Overlay */}
            {/* <div className='absolute flex-row top-0 left-0 right-0 bottom-0 bg-white/10 z-[3]'/> */}
            
            <div className='p-4 text-white text-xl text-center bg-brown z-[2]  w-[100%] mb-[7rem]'>
                <p className='py-3 '>{message}</p>
                <Link href='/portfolio'><button className='px-8 py-2 border hover:bg-white hover:text-brown'>Cliquez ici</button></Link>
            </div>
        </div>    
  )
}

export default About