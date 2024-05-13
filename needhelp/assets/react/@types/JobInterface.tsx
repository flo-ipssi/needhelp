export interface JobInterface { 
    id: number,
    customer?: {
        username?: string|null|undefined,
        createdAt?: string|null|undefined,
        updatedAt?: string|null|undefined
    },
    title: string,
    description: string|null,
    status: string,
    createdAt: string,
    updatedAt: string|null
}