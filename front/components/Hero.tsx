import React from 'react'

const Hero = () => {
  return (
    <div className="flex h-screen textLibre">
        
        <div className='absolute flex-row top-0 left-0 right-0 bottom-0  bg-black/20 z-[2]' />
        <div className='flex columns-2 items-strech justify-between my-[7rem]'>
            <img src="/pictures.png" alt="photo portraits" className='ml-8'/>
            <blockquote className=' self-center justify-center text-white text-2xl rounded-md text-wrap text-center bg-brown w-[40%]  p-4'>
            “Je vous propose d’immortaliser vos moments de bonheur et d’amour 🤍”
            </blockquote>
        </div>
    </div>
  )
}

export default Hero